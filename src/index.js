import express from "express";
import cors from "cors";
import AuthRouter from "./routes/AuthRouter.js";
import DetectRouter from "./routes/DetectRouter.js";
import ReportRouter from "./routes/ReportRouter.js";
import ArticleRouter from "./routes/ArticleRouter.js";

const app = express();

app.use(
  cors({
    origin: true,
  })
);

app.use(express.json({ limit: "2mb" }));

const port = 3000;

app.get("/", (req, res) => {
  res.send("Kelompok 35 Tubes WBD 2 :)");
});

app.use("/auth", AuthRouter);
app.use("/detect", DetectRouter);
app.use("/report", ReportRouter);
app.use("/article", ArticleRouter);

app.listen(port, () => {
  console.log(`Server is running on port ${port}`);
});
