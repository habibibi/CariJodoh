import CustomException from "../error/CustomException.js";

export default class ReportController {
  constructor(reportService) {
    this.reportService = reportService;
  }

  async getAllReports(req, res) {
    try {
      const page = req.query?.page || 1;
      const users = await this.reportService.getAllReports(page);
      res
        .status(200)
        .json({ data: users, message: "Berhasil mendapatkan list reports!" });
    } catch (error) {
      res.status(error.code || 500).json({
        message: error.message || "Internal Server Error",
      });
    }
  }

  async reportUser(req, res) {
    try {
      const data = req.body;
      const createdReport = await this.reportService.reportUser(data);
      res
        .status(201)
        .json({ data: createdReport, message: "Berhasil me-report user!" });
    } catch (error) {
      res.status(error.code || 500).json({
        message: error.message || "Internal Server Error",
      });
    }
  }

  async blockUser(req, res) {
    try {
      if (!req.params.user_id) {
        throw CustomException("User ID not found", 404);
      } else if (!req.body.username) {
        throw CustomException("Username not found", 404);
      } else if (!req.body.report_detail) {
        throw CustomException("report_detail not found", 404);
      }

      await this.reportService.blockUser(
        req.params.user_id,
        req.body.username,
        req.body.report_detail
      );

      res.status(202).json({ message: "Berhasil memblokir user!" });
    } catch (error) {
      res.status(error.code || 500).json({
        message: error.message || "Internal Server Error",
      });
    }
  }

  async deleteReport(req, res) {
    try {
      if (!req.params.report_id) {
        throw CustomException("Report ID not found", 404);
      }
      await this.reportService.deleteReport(req.params.report_id);
      res.status(202).json({ message: "Berhasil delete report!" });
    } catch (error) {
      res.status(error.code || 500).json({
        message: error.message || "Internal Server Error",
      });
    }
  }
}
