import redis from "redis";

const client = redis.createClient({
  url: `redis://${process.env.REDIS_HOST}:${process.env.REDIS_PORT}`,
});

await client.connect();

// Handle Redis connection errors
client.on("error", (err) => {
  console.error(`Redis Error: ${err}`);
});

export default client;
