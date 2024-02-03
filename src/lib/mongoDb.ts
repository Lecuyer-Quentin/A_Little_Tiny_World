import mongoose from "mongoose"

if (!process.env.MONGODB_URI) {
  throw new Error('Invalid/Missing environment variable: "MONGODB_URI"')
}

const MONGODB_URI : string = process.env.MONGODB_URI

// Type for mongoose connection in global scope
let globalWithMongoose = global as typeof globalThis & { mongoose: any }

// Caching the mongoose instance
let cached = globalWithMongoose.mongoose
if (!cached) {
  cached = globalWithMongoose.mongoose = { conn: null, promise: null }
}

// Connect to MongoDB
export default async function dbConnect() {
  if (cached.conn) {
    return cached.conn
  }

  if (!cached.promise) {
    const opts = {
      bufferCommands: false,
    }

    cached.promise = mongoose.connect(MONGODB_URI, opts).then((mongoose) => {
      return mongoose
    })
  }
  cached.conn = await cached.promise
  return cached.conn
}


