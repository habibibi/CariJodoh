let chatContainer = document.querySelector(".chat-container");
let refreshButton = document.querySelector(".refresh");
let sendButton = document.getElementById("send-message");
let deleteButton = document.querySelector(".delete-chat");
let popup = document.querySelector(".popup-delete");
let overlay = document.querySelector(".overlay");
let yesButton = document.querySelector(".yes-button");
let noButton = document.querySelector(".no-button");

function chatComponent(name, messages, isUser) {
  divtype = isUser
    ? "<div class='user-chat-component'>"
    : "<div class='other-chat-component'>";
  messageBody = "";
  for (let i = 0; i < messages.length; i++) {
    messageBody += `
    <div class='div-message'>
        <p class='message'>${messages[i]}</p>
    </div>`;
  }
  return (
    divtype +
    `
    <label class='sender-name'>${name}</label>` +
    messageBody +
    "\n" +
    "</div>"
  );
}

function xmlNodesToObject(node) {
  const obj = {};

  if (node.nodeType === 1) {
    // element node
    if (node.attributes.length > 0) {
      obj["attributes"] = {};
      for (let i = 0; i < node.attributes.length; i++) {
        const attribute = node.attributes[i];
        obj["attributes"][attribute.nodeName] = attribute.nodeValue;
      }
    }
  } else if (node.nodeType === 3) {
    // text node
    return node.nodeValue.trim();
  }

  if (node.hasChildNodes()) {
    for (let i = 0; i < node.childNodes.length; i++) {
      const childNode = node.childNodes[i];
      const nodeName = childNode.nodeName;

      if (!obj[nodeName]) {
        obj[nodeName] = xmlNodesToObject(childNode);
      } else {
        if (!obj[nodeName].push) {
          obj[nodeName] = [obj[nodeName]];
        }
        obj[nodeName].push(xmlNodesToObject(childNode));
      }
    }
  }

  return obj;
}

function loadChat() {
  const xhr = new XMLHttpRequest();
  const url = "http://localhost:8001/chat";

  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "text/xml; charset=utf-8");

  let body = `<Envelope xmlns="http://schemas.xmlsoap.org/soap/envelope/">
    <Body>
      <getChat xmlns="http://service.carijodoh/">
        <userIdSender xmlns="">${user_id}</userIdSender>
        <userIdReceiver xmlns="">${other_id}</userIdReceiver>
        <apiKey xmlns="">${API_KEY_SOAP}</apiKey>
      </getChat>
    </Body>
  </Envelope>`;

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        const parser = new DOMParser();
        const xmlDoc = parser.parseFromString(xhr.responseText, "text/xml");
        const data = xmlNodesToObject(xmlDoc.getElementsByTagName("return")[0]);
        chatContainer.innerHTML = ``;
        if (data && data.data && data.data instanceof Array) {
          let currentChat = null;
          let chats = [];
          data.data.forEach((chat, index, array) => {
            if (currentChat == null) currentChat = chat.userIdSender["#text"];

            if (currentChat != chat.userIdSender["#text"]) {
              chatContainer.innerHTML += chatComponent(
                chat.userIdSender["#text"] == user_id ? other_name : our_name,
                chats,
                chat.userIdSender["#text"] != user_id
              );
              chats = [];
            }

            chats.push(chat.message["#text"]);
            currentChat = chat.userIdSender["#text"];

            if (index === array.length - 1) {
              chatContainer.innerHTML += chatComponent(
                chat.userIdSender["#text"] == user_id ? our_name : other_name,
                chats,
                chat.userIdSender["#text"] == user_id
              );
            }
          });
          chatContainer.scrollTop = chatContainer.scrollHeight;
        } else if (data && data.data) {
          const chat = data.data;
          chatContainer.innerHTML += chatComponent(
            chat.userIdSender["#text"] == user_id ? our_name : other_name,
            [chat.message["#text"]],
            chat.userIdSender["#text"] == user_id
          );
        }
      } else {
        console.error("Error:", xhr.status, xhr.statusText);
      }
    }
  };

  xhr.send(body);
}

loadChat();

function sendMessage() {
  if (
    document.getElementById("message-box").value === undefined ||
    document.getElementById("message-box").value === ""
  ) {
    return;
  }

  if (document.getElementById("message-box").value.length > 900) {
    showToast("Pesan tidak boleh lebih dari 900 karakter!");
    return;
  }

  const xhr = new XMLHttpRequest();
  const url = "http://localhost:8001/chat";

  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "text/xml; charset=utf-8");

  const message = document.getElementById("message-box").value;
  let body = `<Envelope xmlns="http://schemas.xmlsoap.org/soap/envelope/">
    <Body>
      <createChat xmlns="http://service.carijodoh/">
        <userIdSender xmlns="">${user_id}</userIdSender>
        <userIdReceiver xmlns="">${other_id}</userIdReceiver>
        <message xmlns="">${message}</message>
        <apiKey xmlns="">${API_KEY_SOAP}</apiKey>
      </createChat>
    </Body>
  </Envelope>`;

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        loadChat();
        document.getElementById("message-box").value = "";
      } else {
        console.error("Error:", xhr.status, xhr.statusText);
      }
    }
  };

  xhr.send(body);
}

function deleteChat() {
  const xhr = new XMLHttpRequest();
  const url = "http://localhost:8001/chat";

  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "text/xml; charset=utf-8");

  let body = `<Envelope xmlns="http://schemas.xmlsoap.org/soap/envelope/">
    <Body>
      <deleteChat xmlns="http://service.carijodoh/">
        <userIdSender xmlns="">${user_id}</userIdSender>
        <userIdReceiver xmlns="">${other_id}</userIdReceiver>
        <apiKey xmlns="">${API_KEY_SOAP}</apiKey>
      </deleteChat>
    </Body>
  </Envelope>`;

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        loadChat();
        showToast("Chat berhasil di-delete!");
      } else {
        console.error("Error:", xhr.status, xhr.statusText);
      }
    }
  };

  xhr.send(body);
}

sendButton.addEventListener("click", () => {
  sendMessage();
});

refreshButton.addEventListener("click", () => {
  loadChat();
});

yesButton.addEventListener("click", () => {
  deleteChat();
  popup.style.display = "none";
  overlay.style.display = "none";
});

noButton.addEventListener("click", () => {
  popup.style.display = "none";
  overlay.style.display = "none";
});

deleteButton.addEventListener("click", () => {
  popup.style.display = "block";
  overlay.style.display = "block";
});
