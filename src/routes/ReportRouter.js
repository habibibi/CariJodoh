import express from "express";
import ReportService from "../services/ReportService.js";
import ReportController from "../controllers/ReportController.js";
import AuthenticationMiddleware from "../middlewares/AuthenticationMiddleware.js";

const reportRouter = express.Router();
const reportService = new ReportService();
const reportController = new ReportController(reportService);
const authenticationMiddleware = new AuthenticationMiddleware();

reportRouter.use(
  authenticationMiddleware.authenticate.bind(authenticationMiddleware)
);

reportRouter.get("/", reportController.getAllReports.bind(reportController));

reportRouter.post("/", reportController.reportUser.bind(reportController));

reportRouter.delete(
  "/block/:user_id",
  reportController.blockUser.bind(reportController)
);

export default reportRouter;
