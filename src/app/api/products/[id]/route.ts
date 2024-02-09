import { NextResponse, NextRequest } from "next/server";
import { ProductModel } from "@/model/product";
import { updateProduct, deleteProduct } from "@/utils/controller/product";


export async function PUT(req: Request) {
    const { _id, title, description, price, inStock, category } = await req.json();
    if (!_id || !title || !description || !price || !category ) {
        return NextResponse.json({ error: "_id, title, description, price, category are required" });
    }
    const product = { title, description, price, inStock, category } as ProductModel;
    try {
        const updatedProduct = await updateProduct(_id, product);
        return NextResponse.json({ message: "Product updated", product: updatedProduct });
    } catch (error) {
        return NextResponse.json({ message: "PUT: Error updating product"}, { status: 500 });
    }
}

export async function DELETE(req: NextRequest) {
        const { _id } = await req.json();
        if (!_id) {
            return NextResponse.json({ error: "Id is required" });
        }
        try {
            await deleteProduct(_id);
            return NextResponse.json({ message: "Product deleted" });
        } catch (error) {
            return NextResponse.json({ message: "Route : Error deleting product"}, { status: 500 });
        }
    }
