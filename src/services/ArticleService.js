import CustomException from "../error/CustomException.js";

export default class ArticleService {
  
  async addArticle(data) {
    var body = `<Envelope xmlns="http://schemas.xmlsoap.org/soap/envelope/">
  <Body>
    <createArticle xmlns="http://service.carijodoh/">
      <author xmlns="">${data.author}</author>
      <title xmlns="">${data.title}</title>
      <content xmlns="">${data.content}</content>
      <image xmlns="">${data.image}</image>
      <apiKey xmlns="">${process.env.SOAP_API_KEY}</apiKey>
    </createArticle>
  </Body>
</Envelope>`

    const headers = new Headers({
        'Content-Type': 'text/xml',
    });

    const fetchOptions = {
        method: 'POST',
        body: body,
        headers: headers
    };

    const response = await fetch(process.env.SOAP_API_URL + "article", fetchOptions);

    if (!response.ok) {
      throw CustomException(`${response.statusText}`, response.status);
    }
  }
}
