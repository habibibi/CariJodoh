import prisma from "../../prisma/PrismaClient.js";
import CustomException from "../error/CustomException.js";
import bcrypt from "bcryptjs";

export class AuthService {
  async getAllUsers() {
    const allUsers = await prisma.security.findMany();
    return allUsers;
  }

  async login(data) {
    // Error handling missing params
    if (!data.username || !data.password) {
      throw CustomException("Username and password are required", 400);
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

    const passwordMatch = await bcrypt.compare(password, user.password);

    if (!passwordMatch) {
      throw CustomException("Invalid password", 401);
    }

    return user;
  }

  async register(data) {
    // Error handling missing params
    if (!data.username || !data.password) {
      throw CustomException("Username and password are required", 400);
    }

    const allUsers = await this.getAllUsers();

    for (let existingUser of allUsers) {
      if (existingUser.username === data.username) {
        throw CustomException("Username already registered", 409);
      }
    }

    const salt = bcrypt.genSaltSync(Number(process.env.SALT_ROUNDS));
    const hashedPassword = bcrypt.hashSync(data.password, salt);

    const createdUser = await prisma.security.create({
      data: {
        username: data.username,
        password: hashedPassword,
      },
    });
    return createdUser;
  }
}
