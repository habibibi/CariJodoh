import express from "express";
import DetectService from "../services/DetectService.js";
import DetectController from "../controllers/DetectController.js";
import AuthenticationMiddleware from "../middlewares/AuthenticationMiddleware.js";

const detectRouter = express.Router();
const detectService = new DetectService();
const detectController = new DetectController(detectService);
const authenticationMiddleware = new AuthenticationMiddleware();

detectRouter.use(
  authenticationMiddleware.authenticate.bind(authenticationMiddleware)
);

detectRouter.get("/users", detectController.getAllUsers.bind(detectController));

detectRouter.get(
  "/users/:user_id",
  detectController.getUserById.bind(detectController)
);

detectRouter.post(
  "/users/:user_id",
  detectController.blockUser.bind(detectController)
);

export default detectRouter;
