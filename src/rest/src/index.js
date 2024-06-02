import express from "express";
import cors from "cors";
import AuthRouter from "./routes/AuthRouter.js";
import DetectRouter from "./routes/DetectRouter.js";
import ReportRouter from "./routes/ReportRouter.js";
import ArticleRouter from "./routes/ArticleRouter.js";
import cookieParser from "cookie-parser";
import hpp from "hpp";

const app = express();

app.use(
  cors({
    origin: [
      "http://localhost:5173",
      "http://localhost:8080",
      "http://localhost:8001",
    ],
    credentials: true,
    exposedHeaders: ["set-cookie"],
  })
);
app.use(hpp());
app.use(cookieParser());
app.use(express.json({ limit: "2mb" }));

const port = 3000;

app.get("/", (req, res) => {
  res.send("Kelompok 35 Tubes WBD 2 :)");
});

app.use("/", AuthRouter);
app.use("/users", DetectRouter);
app.use("/report", ReportRouter);
app.use("/article", ArticleRouter);

app.listen(port, () => {
  console.log(`Server is running on port ${port}`);
});
