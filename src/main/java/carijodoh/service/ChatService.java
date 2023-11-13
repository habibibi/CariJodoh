package carijodoh.service;

import carijodoh.model.DataChat;
import carijodoh.repository.ChatRepository;
import io.github.cdimascio.dotenv.Dotenv;

import javax.jws.HandlerChain;
import javax.jws.WebMethod;
import javax.jws.WebParam;
import javax.jws.WebService;

@WebService
@HandlerChain(file = "handler-chains.xml")
public class ChatService {
    private static final ChatRepository chatRepository = new ChatRepository();

    @WebMethod
    public String createChat(
            @WebParam(name = "userIdSender") int userIdSender,
            @WebParam(name = "userIdReceiver") int userIdReceiver,
            @WebParam(name = "message") String message,
            @WebParam(name = "apiKey") String apiKey){
        if (!apiKey.equals(Dotenv.load().get("API_KEY_PHP")) && !apiKey.equals(Dotenv.load().get("API_KEY_REST"))) {
            return "Not authorized";
        } else {
            return chatRepository.createChat(userIdSender, userIdReceiver, message);
        }
    }

    @WebMethod
    public DataChat getChat(
            @WebParam(name = "userIdSender") int userIdSender,
            @WebParam(name = "userIdReceiver") int userIdReceiver,
            @WebParam(name = "apiKey") String apiKey){
        if (!apiKey.equals(Dotenv.load().get("API_KEY_PHP")) && !apiKey.equals(Dotenv.load().get("API_KEY_REST"))) {
            return new DataChat();
        } else {
            return chatRepository.getChat(userIdSender, userIdReceiver);
        }
    }

    @WebMethod
    public String deleteChat(
            @WebParam(name = "userIdSender") int userIdSender,
            @WebParam(name = "userIdReceiver") int userIdReceiver,
            @WebParam(name = "apiKey") String apiKey){
        if (!apiKey.equals(Dotenv.load().get("API_KEY_PHP")) && !apiKey.equals(Dotenv.load().get("API_KEY_REST"))) {
            return "Not authorized";
        } else {
            return chatRepository.deleteChat(userIdSender, userIdReceiver);
        }
    }
}
