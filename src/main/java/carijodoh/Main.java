package carijodoh;

import javax.xml.ws.Endpoint;

import carijodoh.middleware.LoggerServlet;
import carijodoh.service.ArticleService;
import carijodoh.service.ChatService;
import carijodoh.util.HibernateUtil;

import java.util.ArrayList;
import java.util.List;
import javax.xml.ws.handler.Handler;

public class Main {
    public static void main(String[] args){
        // Initialize Hibernate session factory
        HibernateUtil.getSessionFactory();

        // Create and publish the web service endpoint
        String addressArticle = "http://localhost:8001/article";
        String addressChat = "http://localhost:8001/chat";
        Endpoint endpointArticle = Endpoint.create(new ArticleService());
        Endpoint endpointChat = Endpoint.create(new ChatService());

        // Add a handler to the endpoint's handler chain
        List<Handler> handlerChain = new ArrayList<>();
        handlerChain.add(new LoggerServlet());
        endpointArticle.getBinding().setHandlerChain(handlerChain);
        endpointChat.getBinding().setHandlerChain(handlerChain);

        // Publish the endpoint
        endpointArticle.publish(addressArticle);
        endpointChat.publish(addressChat);
    }
}
