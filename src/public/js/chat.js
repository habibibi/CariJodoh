function chatComponent(name, messages, isUser)
{
    divtype = isUser ? "<div class='user-chat-component'>" : "<div class='other-chat-component'>";
    messageBody = "";
    for (let i = 0; i < messages.length; i++)
    {
        messageBody += `
    <div class='message'>
        <p>${messages[i]}</p>
    </div>`
    }
    return divtype + `
    <label class='sender-name'>${name}</label>` +
    messageBody + "\n" +
    "</div>";

}

console.log(chatComponent("halo", ["aasdasd", "basdasd", "casdasd"], true));

function loadChat(){


}

loadChat();

function sendMessage(){
    
}
