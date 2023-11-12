package carijodoh.service;

import carijodoh.model.DataPagination;
import carijodoh.repository.ArticleRepository;
import io.github.cdimascio.dotenv.Dotenv;

import javax.jws.HandlerChain;
import javax.jws.WebMethod;
import javax.jws.WebService;

@WebService
@HandlerChain(file = "handler-chains.xml")
public class ArticleService {
    private static final ArticleRepository articleRepository = new ArticleRepository();

    @WebMethod
    public String createArticle(String author, String title, String content, String imagePath, String apiKey){
        if (!apiKey.equals(Dotenv.load().get("API_KEY"))) {
            return "Not authorized";
        } else {
            return articleRepository.createArticle(author, title, content, imagePath);
        }
    }

    @WebMethod
    public DataPagination getAllArticles(int page, String apiKey){
        if (!apiKey.equals(Dotenv.load().get("API_KEY"))) {
            return new DataPagination();
        } else {
            return articleRepository.getAllArticles(page);
        }
    }
}
