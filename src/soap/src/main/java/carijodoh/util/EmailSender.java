package carijodoh.util;

import io.github.cdimascio.dotenv.Dotenv;
import jakarta.mail.MessagingException;
import jakarta.mail.Transport;
import jakarta.mail.internet.InternetAddress;
import jakarta.mail.internet.MimeMessage;
import java.util.Properties;

public class EmailSender implements Runnable {
    private final String toEmail;
    private final String subject;
    private final String body;

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
            message.setFrom(new InternetAddress(Dotenv.load().get("MAIL_SENDER", "13521124@std.stei.itb.ac.id")));
            message.setRecipients(jakarta.mail.Message.RecipientType.TO, InternetAddress.parse(toEmail));
            message.setSubject(subject);
            message.setText(body);

            // Authenticate and send the message
            Transport transport = session.getTransport("smtp");
            transport.connect(Dotenv.load().get("MAIL_USERNAME", ""), Dotenv.load().get("MAIL_PASSWORD", ""));
            transport.sendMessage(message, message.getAllRecipients());
            transport.close();
        } catch (MessagingException e) {
            e.printStackTrace();
        }
    }
}

