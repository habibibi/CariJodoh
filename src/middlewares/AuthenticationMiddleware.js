export class AuthenticationMiddleware {
  authenticate = async (req, res, next) => {
    try {
      const token = req.header("Authorization")?.replace("Bearer ", "");
      if (!token) {
        res.status(401).json({
          message: "Unauthorized",
        });
        return;
      }

      req.token = jwt.verify(token, jwtConfig.secret);

      next();
    } catch (error) {
      res.status(500).json({
        message: "Internal Server Error",
      });
    }
  };
}
