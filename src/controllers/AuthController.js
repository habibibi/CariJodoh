import jwt from "jsonwebtoken";

const secretKey = process.env.SECRET_KEY;

export class AuthController {
  constructor(authService) {
    this.authService = authService;
  }

  async login(req, res) {
    try {
      const data = req.body;
      const user = await this.authService.login(data);
      const token = jwt.sign(
        {
          user_id: user.id,
          username: user.username,
          exp: Math.floor(Date.now() / 1000) + 86400,
        },
        secretKey
      );
      res.status(201).json({ token, message: "Berhasil melakukan login." });
    } catch (error) {
      res.status(error.code || 500).json({
        message: error.message || "Internal Server Error",
      });
    }
  }

  async register(req, res) {
    try {
      const data = req.body;
      const newUser = await this.authService.register(data);
      res
        .status(201)
        .json({ user: newUser, message: "Berhasil registrasi user baru." });
    } catch (error) {
      res.status(error.code || 500).json({
        message: error.message || "Internal Server Error",
      });
    }
  }
}
