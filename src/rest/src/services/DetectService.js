import CustomException from "../error/CustomException.js";
import prisma from "../../prisma/PrismaClient.js";

export default class DetectService {
  async getAllUsers(page, search) {
    const perPage = 10;
    const apiUrl =
      process.env.PHP_URL + `user/users?api_key=${process.env.API_KEY_PHP}`;

    const response = await fetch(apiUrl);
    if (!response.ok) {
      throw CustomException(
        `Failed to fetch data: ${response.status} - ${response.statusText}`,
        response.status
      );
    }

    let data = await response.json();
    const startIndex = (page - 1) * perPage;
    const endIndex = page * perPage;

    if (search && /\S/.test(search)) {
      // Define filtered data
      let filteredData = { users: [] };

      // Convert the search term to lowercase
      const lowercaseSearch = search.toLowerCase();

      // Find anomaly
      data.users.forEach((user) => {
        user.anomalies = "";

        if (user.nama_panggilan.toLowerCase().includes(lowercaseSearch)) {
          user.anomalies += "Nama Panggilan, ";
        }

        if (user.nama_lengkap.toLowerCase().includes(lowercaseSearch)) {
          user.anomalies += "Nama Lengkap, ";
        }

        if (user.hobi.toLowerCase().includes(lowercaseSearch)) {
          user.anomalies += "Hobi, ";
        }

        if (user.interest.toLowerCase().includes(lowercaseSearch)) {
          user.anomalies += "Interest, ";
        }

        if (user.zodiak.toLowerCase().includes(lowercaseSearch)) {
          user.anomalies += "Zodiak, ";
        }

        if (user.ketidaksukaan.toLowerCase().includes(lowercaseSearch)) {
          user.anomalies += "Ketidaksukaan, ";
        }

        if (user.domisili.toLowerCase().includes(lowercaseSearch)) {
          user.anomalies += "Domisili, ";
        }

        // Check if there are any anomalies to add to the filteredData
        if (user.anomalies.length > 0) {
          // Remove the trailing comma and space
          user.anomalies = user.anomalies.slice(0, -2);
          filteredData.users.push(user);
        }
      });

      const totalPages = Math.ceil(filteredData.users.length / perPage);
      const totalAnomalies = filteredData.users.length;
      filteredData.users = filteredData.users.slice(startIndex, endIndex);
      return { users: filteredData, totalPages, totalAnomalies };
    }

    const totalPages = Math.ceil(data.users.length / perPage);
    const totalAnomalies = data.users.length;
    data.users = data.users.slice(startIndex, endIndex);
    return { users: data, totalPages, totalAnomalies };
  }

  async getUserById(user_id) {
    const apiUrl =
      process.env.PHP_URL +
      `user/profile/${user_id}?api_key=${process.env.API_KEY_PHP}`;
    const response = await fetch(apiUrl);
    if (!response.ok) {
      throw CustomException(
        `Failed to fetch data: ${response.status} - ${response.statusText}`,
        response.status
      );
    }

    const data = await response.json();
    return data;
  }

  async blockUser(user_id, username) {
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

    await prisma.blocked.create({
      data: {
        user_id: +user_id,
        username: username,
        blocked_detail: "-",
      },
    });
  }
}
