import jwt from "jsonwebtoken";

export default class AuthenticationMiddleware {
  async authenticate(req, res, next) {
    try {
      if (req.query?.api_key && req.query?.api_key == process.env.API_KEY_PHP) {
        next();
      } else {
        const token = req.cookies.token;

        if (!token) {
          res.status(403).json({
            message: "Forbidden Access",
          });
          return;
        }

        req.token = jwt.verify(token, process.env.SECRET_KEY);
        next();
      }
    } catch (error) {
      return res.status(500).json({
        message: "Internal Server Error",
      });
    }
  }
}
