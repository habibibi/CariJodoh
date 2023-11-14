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
import java.sql.Timestamp;
import java.time.LocalDateTime;
import java.util.List;

public class ChatRepository {
    public String createChat(int userIdSender, int userIdReceiver, String message) {
        Session session = null;
        try {
            Chat newChat = new Chat(userIdSender, userIdReceiver, message, new Timestamp(System.currentTimeMillis()));
            SessionFactory sessionFactory = HibernateUtil.getSessionFactory();
            session = sessionFactory.getCurrentSession();

            session.beginTransaction();
            session.save(newChat);
            session.getTransaction().commit();

            return "New chat created!";
        } catch (Exception e) {
            if (session != null && session.getTransaction().isActive()) {
                session.getTransaction().rollback();
            }
            return "Error creating chat";
        }
    }

    public DataChat getChat(int userIdSender, int userIdReceiver) {
        Session session = null;
        try {
            DataChat data = new DataChat();

            SessionFactory sessionFactory = HibernateUtil.getSessionFactory();
            session = sessionFactory.getCurrentSession();
            session.beginTransaction();

            CriteriaBuilder builder = session.getCriteriaBuilder();
            CriteriaQuery<Chat> criteria = builder.createQuery(Chat.class);
            Root<Chat> root = criteria.from(Chat.class);

            // Create a condition for both sender = receiver and receiver = sender
            Predicate predicateSenderReceiver = builder.and(
                    builder.equal(root.get("userIdSender"), userIdSender),
                    builder.equal(root.get("userIdReceiver"), userIdReceiver)
            );
            Predicate predicateReceiverSender = builder.and(
                    builder.equal(root.get("userIdSender"), userIdReceiver),
                    builder.equal(root.get("userIdReceiver"), userIdSender)
            );
            Predicate finalPredicate = builder.or(predicateSenderReceiver, predicateReceiverSender);

            // Order by timestamp in descending order
            criteria.orderBy(builder.asc(root.get("timestamp")));
            criteria.select(root).where(finalPredicate);
            TypedQuery<Chat> query = session.createQuery(criteria);

            List<Chat> chats = query.getResultList();
            data.setData(chats);
            session.getTransaction().commit();

            return data;
        } catch (Exception e) {
            if (session != null && session.getTransaction().isActive()) {
                session.getTransaction().rollback();
            }
            return null;
        }
    }

    public String deleteChat(int userIdSender, int userIdReceiver) {
        Session session = null;
        try {
            SessionFactory sessionFactory = HibernateUtil.getSessionFactory();
            session = sessionFactory.getCurrentSession();
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
            if (session != null && session.getTransaction().isActive()) {
                session.getTransaction().rollback();
            }
            return "Error deleting chat";
        }
    }
}
