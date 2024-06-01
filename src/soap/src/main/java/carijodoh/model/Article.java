package carijodoh.model;

import javax.persistence.*;
import javax.xml.bind.annotation.*;
import java.io.IOException;
import java.io.Serializable;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;

@Entity
@XmlRootElement
@XmlAccessorType(XmlAccessType.FIELD)
public class Article implements Serializable {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(nullable = false)
    private int articleId;

    @Column(nullable = false)
    private String author;

    @Column(nullable = false)
    private String title;

    @Column(nullable = false, length = 900)
    private String content;

    @Column(nullable = false)
    private String imagePath;

    @Transient
    private byte[] image;

    public Article() {}

    public Article(String author, String title, String content, String imagePath){
        this.author = author;
        this.title = title;
        this.content = content;
        this.imagePath = imagePath;
    }

    public int getArticleId(){
        return this.articleId;
    }

    public String getAuthor() {
        return author;
    }

    public String getTitle() {
        return title;
    }

    public String getContent(){
        return content;
    }

    public String getImagePath() {
        return imagePath;
    }

    public void setArticleId(int articleId) {
        this.articleId = articleId;
    }

    public void setAuthor(String author) {
        this.author = author;
    }

    public void setContent(String content) {
        this.content = content;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public void setImagePath(String imagePath) {
        this.imagePath = imagePath;
    }

    public void setImage(){
        if(this.imagePath != null){
            try {
                Path path = Paths.get(this.imagePath);

                // Read all bytes from the file and set to the image byte array
                this.image = Files.readAllBytes(path);
            } catch (IOException e) {
                // Do Nothing
            }
        }
    }
}