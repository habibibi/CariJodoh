package carijodoh.service;

import carijodoh.model.DataPagination;
import carijodoh.repository.ArticleRepository;
import io.github.cdimascio.dotenv.Dotenv;

import javax.jws.HandlerChain;
import javax.jws.WebMethod;
import javax.jws.WebParam;
import javax.jws.WebService;
import java.io.IOException;
import java.util.Base64;

@WebService
@HandlerChain(file = "handler-chains.xml")
public class ArticleService {
    private static final ArticleRepository articleRepository = new ArticleRepository();

    @WebMethod
    public String createArticle(
            @WebParam(name = "author") String author,
            @WebParam(name = "title") String title,
            @WebParam(name = "content") String content,
            @WebParam(name = "image") String base64Image,
            @WebParam(name = "apiKey") String apiKey) throws IOException {
        if (!apiKey.equals(Dotenv.load().get("API_KEY_PHP")) && !apiKey.equals(Dotenv.load().get("API_KEY_REST"))) {
            return "Not authorized";
        } else {
            byte[] image = Base64.getDecoder().decode(base64Image);
            return articleRepository.createArticle(author, title, content, image);
        }
    }

    @WebMethod
    public DataPagination getAllArticles(
            @WebParam(name = "page") int page,
            @WebParam(name = "apiKey") String apiKey){
        if (!apiKey.equals(Dotenv.load().get("API_KEY_PHP")) && !apiKey.equals(Dotenv.load().get("API_KEY_REST"))) {
            return new DataPagination();
        } else {
            return articleRepository.getAllArticles(page);
        }
    }
}
