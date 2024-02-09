import mongoose from "mongoose";

const productSchema = new mongoose.Schema({
    title: { type: String, required: [true, "Title is required"] },
    description: { type: String, required: [true, "Description is required"] },
    price: { type: Number, required: [true, "Price is required"] },
    category: { type: String , required: [true, "Category is required"] },
    inStock: { type: Boolean },
    createdAt: { type: Date, default: Date.now },
    updatedAt: { type: Date, default: Date.now }
},
    { timestamps: true }
)


export interface ProductModel {
    title: string;
    description: string;
    price: number;
    category: string;
    inStock: boolean;
    createdAt: Date;
    updatedAt: Date;
}


const Product = mongoose.models.Product || mongoose.model<ProductModel>("Product", productSchema);

export default Product;

