FROM node:alpine

WORKDIR /app

COPY package.json yarn.lock ./

COPY prisma ./prisma/

RUN yarn

RUN yarn prisma generate

COPY . .

EXPOSE 3000

COPY wait-for-mysql.sh /app/
RUN chmod +x /app/wait-for-mysql.sh

CMD ["/bin/sh", "/app/wait-for-mysql.sh", "mysql-rest:3306", "/app/startup.sh"]