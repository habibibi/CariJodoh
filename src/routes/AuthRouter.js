import express from "express";
import { AuthService } from "../services/AuthService.js";
import { AuthController } from "../controllers/AuthController.js";

const authRouter = express.Router();
const authService = new AuthService();
const authController = new AuthController(authService);

authRouter.post("/login", authController.login.bind(authController));
authRouter.post("/register", authController.register.bind(authController));

export default authRouter;
