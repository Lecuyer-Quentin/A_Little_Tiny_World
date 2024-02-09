import Product from "@/model/product";
import dbConnect from "@/lib/mongoDb";
import { NextResponse } from "next/server";
import { ProductModel } from "@/model/product";


type Props = Omit<ProductModel, 'createdAt' | 'updatedAt'>;


export const createProduct = async (product: Props) => {
    const productAdded  = {
        ...product,
    }
    try{
        await dbConnect();
        if (!productAdded.title || !productAdded.description || !productAdded.price || !productAdded.category ) {
            return NextResponse.json({ message: "All are required" }, { status: 400 });
        }
        const newProduct =  await Product.create(productAdded);
        return newProduct;
    } catch (error) {
        return NextResponse.json({ message: "Error creating Product"}, { status: 500 });
    }
}


export const getProducts = async () => {
    try {
        await dbConnect();
        const products = await Product.find({});
        return products;
    } catch (error) {
        return NextResponse.json({ message: "Error getting products"}, { status: 500 });
    }
}

export const updateProduct = async (_id: string, product: Props) => {
    try {
        await dbConnect();
        if (!_id || !product.title || !product.description || !product.price || !product.category ) {
            return NextResponse.json({ message: "All are required" }, { status: 400 });
        }
        const updatedProduct = await Product.findByIdAndUpdate(_id, product);
        return updatedProduct;
    } catch (error) {
        return NextResponse.json({ message: "Error updating product"}, { status: 500 });
    }
}

export const deleteProduct = async (_id: string) => {
    try {
        await dbConnect();
        if (!_id) {
            return NextResponse.json({ message: "Id is required" }, { status: 400 });
        }
        const deletedProduct = await Product.findByIdAndDelete(_id);
        return deletedProduct;
    } catch (error) {
        return NextResponse.json({ message: "Error deleting product"}, { status: 500 });
    }
}