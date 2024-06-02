import CustomException from "../error/CustomException.js";

export default class ArticleService {
  async addArticle(data) {
    // Error handling missing params
    if (!data.author) {
      throw CustomException(`Tidak ada param author`, 400);
    } else if (!data.title) {
      throw CustomException(`Tidak ada param title`, 400);
    } else if (!data.content) {
      throw CustomException(`Tidak ada param content`, 400);
    } else if (!data.image) {
      throw CustomException(`Tidak ada param image`, 400);
    }

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
</Envelope>`;

    const headers = new Headers({
      "Content-Type": "text/xml",
    });

    const fetchOptions = {
      method: "POST",
      body: body,
      headers: headers,
    };

    const response = await fetch(
      process.env.SOAP_API_URL + "article",
      fetchOptions
    );

    if (!response.ok) {
      throw CustomException(`${response.statusText}`, response.status);
    }
  }
}
