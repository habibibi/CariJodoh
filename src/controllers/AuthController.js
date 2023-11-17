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
          user_id: user.security_id,
          username: user.username,
          exp: Math.floor(Date.now() / 1000) + 86400,
        },
        secretKey
      );

      res.cookie("token", token, {
        expires: new Date(Date.now() + 86400000),
        secure: false,
        httpOnly: true,
      });

      res.status(201).json({
        expired: new Date(Date.now() + 86400000),
        message: "Berhasil melakukan login.",
        security_id: user.security_id,
      });
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

  async logout(req, res) {
    try {
      res.cookie("token", "", {
        expires: new Date(0),
        secure: false,
        httpOnly: true,
      });

      res.status(202).json({
        message: "Berhasil logout.",
      });
    } catch (error) {
      res.status(error.code || 500).json({
        message: error.message || "Internal Server Error",
      });
    }
  }

  async getSecurityById(req, res) {
    try {
      const security = await this.authService.getSecurityById(
        req.params.security_id
      );
      res.status(200).json({
        data: security,
        message: "Berhasil mendapatkan username security",
      });
    } catch (error) {
      res.status(error.code || 500).json({
        message: error.message || "Internal Server Error",
      });
    }
  }
}
