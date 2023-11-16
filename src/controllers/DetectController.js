import CustomException from "../error/CustomException.js";

export default class DetectController {
  constructor(detectService) {
    this.detectService = detectService;
  }

  async getAllUsers(req, res) {
    try {
      let { users, totalPages, totalAnomalies } =
        await this.detectService.getAllUsers(
          req.query?.page || 1,
          req.query?.search || null
        );
      res.status(200).json({
        data: users,
        totalPages: totalPages,
        totalAnomalies: totalAnomalies,
        message: "Berhasil mendapatkan list users",
      });
    } catch (error) {
      res.status(error.code || 500).json({
        message: error.message || "Internal Server Error",
      });
    }
  }

  async getUserById(req, res) {
    try {
      const user = await this.detectService.getUserById(req.params.user_id);
      res
        .status(200)
        .json({ data: user, message: "Berhasil mendapatkan profile user" });
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
      }

      await this.detectService.blockUser(req.params.user_id, req.body.username);
      res.status(200).json({ message: "Berhasil memblokir user!" });
    } catch (error) {
      res.status(error.code || 500).json({
        message: error.message || "Internal Server Error",
      });
    }
  }
}
