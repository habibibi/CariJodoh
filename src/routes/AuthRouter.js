import express from "express";
import { AuthService } from "../services/AuthService.js";
import { AuthController } from "../controllers/AuthController.js";

const authRouter = express.Router();
const authService = new AuthService();
const authController = new AuthController(authService);

authRouter.post("/session", authController.login.bind(authController));
authRouter.delete("/session", authController.logout.bind(authController));
authRouter.post("/security", authController.register.bind(authController));
authRouter.get(
  "/security/:security_id",
  authController.getSecurityById.bind(authController)
);

export default authRouter;
