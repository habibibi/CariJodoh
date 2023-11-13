package carijodoh.repository;

import java.io.File;
import java.io.FileOutputStream;
import java.util.List;
import javax.persistence.TypedQuery;
import javax.persistence.criteria.CriteriaBuilder;
import javax.persistence.criteria.CriteriaQuery;
import javax.persistence.criteria.Root;

import carijodoh.model.Article;
import carijodoh.model.DataPagination;
import carijodoh.util.HibernateUtil;
import org.hibernate.Session;
import org.hibernate.SessionFactory;

public class ArticleRepository {
    public String createArticle(String author, String title, String content, byte[] image){
        try {
            // Determine the path where you want to save the images within the resources directory
            String resourcesPath = "src/main/resources/images/";

            // Create a File object for the resources directory
            File resourcesDir = new File(resourcesPath);

            // If the directory doesn't exist, create it
            if (!resourcesDir.exists()) {
                resourcesDir.mkdirs();
            }

            // Generate a unique filename for the image
            String filename = System.currentTimeMillis() + "_image.jpg";

            // Create the full filepath for the image
            String imagePath = resourcesPath + filename;

            // Create a File object for the image file
            File imageFile = new File(imagePath);

            // Save the image data to the file
            try (FileOutputStream fos = new FileOutputStream(imageFile)) {
                fos.write(image);
            }

            Article newArticle = new Article(author, title, content, imagePath);
            SessionFactory sessionFactory = HibernateUtil.getSessionFactory();
            Session session = sessionFactory.getCurrentSession();

            session.beginTransaction();
            session.save(newArticle);
            session.getTransaction().commit();

            return "New article created!";
        } catch (Exception e){
            return "Error creating article";
        }
    }

    public DataPagination getAllArticles(int page){
        try {
            DataPagination data = new DataPagination();

            SessionFactory sessionFactory = HibernateUtil.getSessionFactory();
            Session session = sessionFactory.getCurrentSession();
            session.beginTransaction();

            CriteriaBuilder builder = session.getCriteriaBuilder();
            CriteriaQuery<Article> criteria = builder.createQuery(Article.class);
            Root<Article> root = criteria.from(Article.class);
            criteria.select(root);
            TypedQuery<Article> query = session.createQuery(criteria);

            List<Article> articles = query.setFirstResult((page - 1) * 6).setMaxResults(6).getResultList();

            for (Article article : articles) {
                article.setImage();
            }

            data.setData(articles);

            int pageCount = this.getPageCount();
            data.setPageCount(pageCount);
            session.getTransaction().commit();

            return data;
        } catch (Exception e) {
            return null;
        }
    }

    public int getPageCount() {
        try {
            SessionFactory sessionFactory = HibernateUtil.getSessionFactory();
            Session session = sessionFactory.getCurrentSession();

            CriteriaBuilder builder = session.getCriteriaBuilder();
            CriteriaQuery<Long> criteria = builder.createQuery(Long.class);
            Root<Article> root = criteria.from(Article.class);
            TypedQuery<Long> query = session.createQuery(criteria);

            long count = query.getSingleResult();
            return (int) Math.ceil((double) count / 6);
        } catch (Exception e) {
            return 0;
        }
    }
}
