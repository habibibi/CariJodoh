package carijodoh.model;

import javax.persistence.*;
import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlRootElement;
import java.sql.Timestamp;

@Entity
@XmlRootElement
@XmlAccessorType(XmlAccessType.FIELD)
public class Logging {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(nullable = false)
    private int loggingId;

    @Lob
    @Column(nullable = false)
    private String description;

    @Column(nullable = false, length = 16)
    private String IP;

    @Column(nullable = false)
    private String endpoint;

    @Column(nullable = false)
    private Timestamp requestedAt;

    private String webService;

    public Logging() {
        // Do nothing
    }

    public int getID() {
        return this.loggingId;
    }

    public String getDescription() {
        return this.description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public String getIP() {
        return this.IP;
    }

    public void setIP(String IP) {
        this.IP = IP;
    }

    public String getEndpoint() {
        return this.endpoint;
    }

    public void setEndpoint(String endpoint) {
        this.endpoint = endpoint;
    }

    public Timestamp getRequestedAt() {
        return this.requestedAt;
    }

    public void setRequestedAt(Timestamp requestedAt) {
        this.requestedAt = requestedAt;
    }

    public String getWebService() {
        return webService;
    }

    public void setWebService(String webService) {
        this.webService = webService;
    }
}