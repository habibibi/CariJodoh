import CustomException from "../error/CustomException.js";
import prisma from "../../prisma/PrismaClient.js";

export default class ReportService {
  async getAllReports(page) {
    const perPage = 10;
    let allReports = await prisma.report.findMany();
    const startIndex = (page - 1) * perPage;
    const endIndex = page * perPage;
    const totalPages = Math.ceil(allReports.length / perPage);
    const totalReports = allReports.length;
    allReports = allReports.slice(startIndex, endIndex);

    return { reports: allReports, totalPages, totalReports };
  }

  async reportUser(data) {
    const { user_id_reporter, user_id_reported, report_detail } = data;
    const report = await prisma.report.findFirst({
      where: {
        user_id_reporter: user_id_reporter,
        user_id_reported: user_id_reported,
      },
    });

    if (report) {
      throw CustomException("User already reported!", 409);
    }

    const createdReport = await prisma.report.create({
      data: {
        user_id_reporter: user_id_reporter,
        user_id_reported: user_id_reported,
        report_detail: report_detail,
      },
    });

    return createdReport;
  }

  async blockUser(user_id) {
    const apiUrl =
      process.env.PHP_URL +
      `user/delete/${user_id}?api_key=${process.env.API_KEY_PHP}`;

    const response = await fetch(apiUrl, {
      method: "DELETE",
    });

    if (!response.ok) {
      throw CustomException(`${response.statusText}`, response.status);
    }

    // If block succeded
    await prisma.report.deleteMany({
      where: {
        OR: [{ user_id_reported: +user_id }, { user_id_reporter: +user_id }],
      },
    });
  }
}
