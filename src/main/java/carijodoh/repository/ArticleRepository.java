package carijodoh.repository;

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
    public String createArticle(String author, String title, String content, String imagePath){
        try {
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
