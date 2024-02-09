import { NextResponse } from "next/server";
import { ProductModel } from "@/model/product";
import { createProduct, getProducts } from "@/utils/controller/product";


export async function POST(req: Request) {
    const { title, description, price, inStock, category } = await req.json();

    if (!title || !description || !price || !category ) {
        return NextResponse.json({ error: "Title, description, price are required" });
    }
    const product = { title, description, price, inStock, category } as ProductModel;
    try{
        const newProduct = await createProduct(product);
        return NextResponse.json({ message: "Product created", product: newProduct }, { status: 201 });
    } catch (error) {
        return NextResponse.json({ message: "GET: Error creating Product"}, { status: 500 });
    }
}

export async function GET() {
    try {
        const products = await getProducts();
        return NextResponse.json({ products });
    } catch (error) {
        return NextResponse.json({ message: "GET: Error finding products"}, { status: 500 });
    }
}
