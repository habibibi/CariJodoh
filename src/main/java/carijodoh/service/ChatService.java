package carijodoh.service;

import carijodoh.model.DataChat;
import carijodoh.repository.ChatRepository;
import io.github.cdimascio.dotenv.Dotenv;

import javax.jws.HandlerChain;
import javax.jws.WebMethod;
import javax.jws.WebService;

@WebService
@HandlerChain(file = "handler-chains.xml")
public class ChatService {
    private static final ChatRepository chatRepository = new ChatRepository();

    @WebMethod
    public String createChat(int userIdSender, int userIdReceiver, String message, String apiKey){
        if (!apiKey.equals(Dotenv.load().get("API_KEY"))) {
            return "Not authorized";
        } else {
            return chatRepository.createChat(userIdSender, userIdReceiver, message);
        }
    }

    @WebMethod
    public DataChat getChat(int userIdSender, int userIdReceiver, String apiKey){
        if (!apiKey.equals(Dotenv.load().get("API_KEY"))) {
            return new DataChat();
        } else {
            return chatRepository.getChat(userIdSender, userIdReceiver);
        }
    }

    @WebMethod
    public String deleteChat(int userIdSender, int userIdReceiver, String apiKey){
        if (!apiKey.equals(Dotenv.load().get("API_KEY"))) {
            return "Not authorized";
        } else {
            return chatRepository.deleteChat(userIdSender, userIdReceiver);
        }
    }
}
