import prisma from "../../prisma/PrismaClient.js";
import CustomException from "../error/CustomException.js";

export class AuthService {
  async getAllUsers() {
    const allUsers = await prisma.security.findMany();
    return allUsers;
  }

  async login(data) {
    // Error handling missing params
    if (!data.username) {
      throw CustomException(`Tidak ada param username`, 400);
    } else if (!data.password) {
      throw CustomException(`Tidak ada param password`, 400);
    }

    const { username, password } = data;

    const user = await prisma.security.findFirst({
      where: {
        username,
      },
    });

    if (!user) {
      throw CustomException("User not found", 404);
    }

    if (user.password !== password) {
      throw CustomException("Invalid password", 401);
    }

    return user;
  }

  async register(data) {
    // Error handling missing params
    if (!data.username) {
      throw CustomException(`Tidak ada param username`, 400);
    } else if (!data.password) {
      throw CustomException(`Tidak ada param password`, 400);
    }

    const allUsers = await this.getAllUsers();

    for (let user of allUsers) {
      if (user.username === data.username) {
        throw CustomException("Already registered", 409);
      }
    }

    const createdUser = await prisma.security.create({
      data: {
        username: data.username,
        password: data.password,
      },
    });
    return createdUser;
  }
}
