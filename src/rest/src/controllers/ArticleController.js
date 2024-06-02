import CustomException from "../error/CustomException.js";

export default class ArticleController {
  constructor(articleService) {
    this.articleService = articleService;
  }

  async addArticle(req, res) {
    try {
      const data = req.body;
      await this.articleService.addArticle(data);
      res.status(200).json({ message: "Berhasil menambah artikel!" });
    } catch (error) {
      res.status(error.code || 500).json({
        message: error.message || "Internal Server Error",
      });
    }
  }
}
