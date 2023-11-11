package carijodoh.model;

import javax.persistence.*;
import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlRootElement;

import java.io.Serializable;
import java.time.LocalDateTime;

@Entity
@XmlRootElement
@XmlAccessorType(XmlAccessType.FIELD)
public class Chat implements Serializable {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(nullable = false)
    private int chatId;

    @Column(nullable = false)
    private int userIdSender;

    @Column(nullable = false)
    private int userIdReceiver;

    @Column(nullable = false)
    private String message;

    @Column(nullable = false)
    private LocalDateTime timestamp;

    public Chat() {}

    public Chat(int userIdSender, int userIdReceiver, String message, LocalDateTime timestamp){
        this.userIdSender = userIdSender;
        this.userIdReceiver = userIdReceiver;
        this.message = message;
        this.timestamp = timestamp;
    }

    public int getChatId() {
        return chatId;
    }

    public int getUserIdReceiver() {
        return userIdReceiver;
    }

    public int getUserIdSender() {
        return userIdSender;
    }

    public LocalDateTime getTimestamp() {
        return timestamp;
    }

    public String getMessage() {
        return message;
    }

    public void setChatId(int chatId) {
        this.chatId = chatId;
    }

    public void setMessage(String message) {
        this.message = message;
    }

    public void setTimestamp(LocalDateTime timestamp) {
        this.timestamp = timestamp;
    }

    public void setUserIdReceiver(int userIdReceiver) {
        this.userIdReceiver = userIdReceiver;
    }

    public void setUserIdSender(int userIdSender) {
        this.userIdSender = userIdSender;
    }
}
