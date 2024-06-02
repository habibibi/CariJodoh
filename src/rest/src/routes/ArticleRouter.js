import express from "express";
import ArticleService from "../services/ArticleService.js";
import ArticleController from "../controllers/ArticleController.js";
import AuthenticationMiddleware from "../middlewares/AuthenticationMiddleware.js";

const articleRouter = express.Router();
const articleService = new ArticleService();
const articleController = new ArticleController(articleService);
const authenticationMiddleware = new AuthenticationMiddleware();

articleRouter.use(
  authenticationMiddleware.authenticate.bind(authenticationMiddleware)
);

articleRouter.post("/", articleController.addArticle.bind(articleController));

export default articleRouter;
