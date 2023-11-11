package carijodoh.repository;

import carijodoh.model.Chat;
import carijodoh.model.DataChat;
import carijodoh.util.HibernateUtil;
import org.hibernate.Session;
import org.hibernate.SessionFactory;
import org.hibernate.query.Query;

import javax.persistence.TypedQuery;
import javax.persistence.criteria.CriteriaBuilder;
import javax.persistence.criteria.CriteriaQuery;
import javax.persistence.criteria.Predicate;
import javax.persistence.criteria.Root;
import java.time.LocalDateTime;
import java.util.List;

public class ChatRepository {
    public String createChat(int userIdSender, int userIdReceiver, String message){
        try {
            Chat newChat = new Chat(userIdSender, userIdReceiver, message, LocalDateTime.now());
            SessionFactory sessionFactory = HibernateUtil.getSessionFactory();
            Session session = sessionFactory.getCurrentSession();

            session.beginTransaction();
            session.save(newChat);
            session.getTransaction().commit();

            return "New chat created!";
        } catch (Exception e){
            return "Error creating chat";
        }
    }

    public DataChat getChat(int userIdSender, int userIdReceiver){
        try {
            DataChat data = new DataChat();

            SessionFactory sessionFactory = HibernateUtil.getSessionFactory();
            Session session = sessionFactory.getCurrentSession();
            session.beginTransaction();

            CriteriaBuilder builder = session.getCriteriaBuilder();
            CriteriaQuery<Chat> criteria = builder.createQuery(Chat.class);
            Root<Chat> root = criteria.from(Chat.class);
            Predicate predicate = builder.and(builder.equal(root.get("userIdSender"), userIdSender), builder.equal(root.get("userIdReceiver"), userIdReceiver));
            criteria.select(root).where(predicate);
            TypedQuery<Chat> query = session.createQuery(criteria);

            List<Chat> chats = query.getResultList();
            data.setData(chats);
            session.getTransaction().commit();

            return data;
        } catch (Exception e) {
            return null;
        }
    }

    public String deleteChat(int userIdSender, int userIdReceiver) {
        try {
            SessionFactory sessionFactory = HibernateUtil.getSessionFactory();
            Session session = sessionFactory.getCurrentSession();
            session.beginTransaction();

            Query query = session.createQuery(
                    "DELETE FROM Chat WHERE (userIdSender = :userIdSender AND userIdReceiver = :userIdReceiver) OR (userIdSender = :userIdReceiver AND userIdReceiver = :userIdSender)"
            );
            query.setParameter("userIdSender", userIdSender);
            query.setParameter("userIdReceiver", userIdReceiver);

            int deletedCount = query.executeUpdate();
            session.getTransaction().commit();

            if (deletedCount > 0) {
                return "Delete chat successful!";
            } else {
                return "No chat found for deletion";
            }
        } catch (Exception e) {
            return "Error deleting chat";
        }
    }
}
