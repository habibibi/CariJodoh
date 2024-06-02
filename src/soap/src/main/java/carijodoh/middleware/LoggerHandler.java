package carijodoh.middleware;

import carijodoh.model.Logging;
import carijodoh.util.HibernateUtil;

import io.github.cdimascio.dotenv.Dotenv;
import org.hibernate.Session;
import org.hibernate.SessionFactory;
import org.w3c.dom.Node;
import org.w3c.dom.NodeList;

import java.sql.Timestamp;
import java.util.Collections;
import java.util.Set;
import javax.servlet.http.HttpServletRequest;
import javax.xml.namespace.QName;
import javax.xml.soap.SOAPBody;
import javax.xml.soap.SOAPEnvelope;
import javax.xml.soap.SOAPException;
import javax.xml.soap.SOAPPart;
import javax.xml.ws.handler.MessageContext;
import javax.xml.ws.handler.soap.SOAPHandler;
import javax.xml.ws.handler.soap.SOAPMessageContext;

public class LoggerHandler implements SOAPHandler<SOAPMessageContext> {
    private void logToDatabase(SOAPMessageContext smc) throws SOAPException {
        boolean isResponse = (boolean) smc.get(MessageContext.MESSAGE_OUTBOUND_PROPERTY);
        if (!isResponse) {
            HttpServletRequest req = (HttpServletRequest) smc.get(MessageContext.SERVLET_REQUEST);

            SOAPPart soapPart = smc.getMessage().getSOAPPart();
            SOAPEnvelope soapEnvelope = soapPart.getEnvelope();
            SOAPBody soapBody = soapEnvelope.getBody();
            String apiKeyValue = getApiKey(soapBody);

            Node operation = soapBody.getChildNodes().item(1);
            Logging logging = getLogging(operation, req, apiKeyValue);

            SessionFactory sessionFactory = HibernateUtil.getSessionFactory();
            Session session = sessionFactory.getCurrentSession();

            session.beginTransaction();
            session.save(logging);
            session.getTransaction().commit();
        }
    }

    private Logging getLogging(Node operation, HttpServletRequest req, String apiKey) {
        String content = String.format("%s", operation.getLocalName());

        NodeList parameters = operation.getChildNodes();
        for (int i = 1; i < parameters.getLength(); i += 2) {
            content = String.format("%s %s(%s)", content, parameters.item(i).getLocalName(), parameters.item(i).getTextContent());
        }

        Logging logging = new Logging();
        logging.setDescription(content);
        logging.setEndpoint(req.getRequestURI());
        logging.setIP(req.getRemoteAddr());
        logging.setRequestedAt(new Timestamp(System.currentTimeMillis()));

        if(apiKey == null){
            logging.setWebService("Unknown");
            return logging;
        }

        if(apiKey.equals(Dotenv.load().get("API_KEY_PHP"))){
            logging.setWebService("Plain Web Service");
        } else if(apiKey.equals(Dotenv.load().get("API_KEY_REST"))){
            logging.setWebService("REST Web Service");
        } else {
            logging.setWebService("Unknown");
        }

        return logging;
    }

    public Set<QName> getHeaders() {
        return Collections.emptySet();
    }

    public boolean handleMessage(SOAPMessageContext smc) {
        try {
            logToDatabase(smc);
            return true;
        } catch (Exception e) {
            return false;
        }
    }

    public boolean handleFault(SOAPMessageContext smc) {
        try {
            logToDatabase(smc);
            return true;
        } catch (Exception e) {
            return false;
        }
    }

    public void close(MessageContext messageContext) {
        // DO NOTHING
    }

    private String getApiKey(SOAPBody soapBody) {
        NodeList methods = soapBody.getChildNodes();
        for (int i = 0; i < methods.getLength(); i++) {
            Node method = methods.item(i);
            if(method.getLocalName() != null){
                NodeList parameters = method.getChildNodes();
                for(int j = 0; j < parameters.getLength(); j++){
                    Node parameter = parameters.item(j);
                    if (parameter.getLocalName() != null && parameter.getLocalName().equals("apiKey")) {
                        return parameter.getTextContent();
                    }
                }
            }

        }
        return null; // Parameter not found
    }
}