package carijodoh.util;

import io.github.cdimascio.dotenv.Dotenv;
import jakarta.mail.MessagingException;
import jakarta.mail.NoSuchProviderException;
import jakarta.mail.Transport;
import jakarta.mail.internet.AddressException;
import jakarta.mail.internet.InternetAddress;
import jakarta.mail.internet.MimeMessage;
import java.util.Properties;

public class EmailSender implements Runnable {
    private String toEmail;
    private String subject;
    private String body;

    public EmailSender(String toEmail, String subject, String body) {
        this.toEmail = toEmail;
        this.subject = subject;
        this.body = body;
    }

    @Override
    public void run() {
        try {
            // Set up email properties
            Properties emailProperties = new Properties();
            emailProperties.put("mail.smtp.host", Dotenv.load().get("MAIL_SMTP_HOST", "sandbox.smtp.mailtrap.io"));
            emailProperties.put("mail.smtp.port", Dotenv.load().get("MAIL_SMTP_PORT", "2525"));
            emailProperties.put("mail.smtp.auth", "true");
            emailProperties.put("mail.smtp.starttls.enable", "true");
            emailProperties.put("mail.smtp.ssl.trust", Dotenv.load().get("MAIL_SMTP_HOST", "sandbox.smtp.mailtrap.io"));

            // Create email session
            jakarta.mail.Session session = jakarta.mail.Session.getInstance(emailProperties);

            // Create a new MimeMessage object
            MimeMessage message = new MimeMessage(session);

            // Set the recipients, subject, and content of the message
            message.setRecipients(jakarta.mail.Message.RecipientType.TO, InternetAddress.parse(toEmail));
            message.setSubject(subject);
            message.setText(body);

            // Authenticate and send the message
            Transport transport = session.getTransport("smtp");
            transport.connect(Dotenv.load().get("MAILTRAP_USERNAME", ""), Dotenv.load().get("MAILTRAP_PASSWORD", ""));
            transport.sendMessage(message, message.getAllRecipients());
            transport.close();
        } catch (MessagingException e) {
            // Do Nothing
        }
    }
}

