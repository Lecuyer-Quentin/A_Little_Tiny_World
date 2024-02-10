'use client'

import { getSortedProducts } from "@/lib/product"
import { useEffect, useState, useCallback, useMemo } from "react"
import CardMd from "@/app/components/card/card-admin"
import UpdateProduct from "@/app/features/product/update"
import AddProduct from "@/app/features/product/add"
import DeleteProduct from "@/app/features/product/delete"
import { Product } from "../../../../../types"

export default function Products() {

    const [products, setProducts] = useState<Product[]>([])
    const [error, setError] = useState<string | null>(null)
    const [loading, setLoading] = useState<boolean>(false)

    const getProducts = useCallback(async () => {
        try {
            const products = await getSortedProducts()
            return products
        } catch (error) {
            setError('Error getting products')
        }
    }, [])

    useEffect(() => {
        setLoading(true)
        getProducts()
        .then((products) => {
            setProducts(products)
        })
        .catch((error) => {
            setError('Error getting products')
        })
        .finally(() => {
            setLoading(false)
        })
    }, [getProducts])

    const memoizedProducts = useMemo(() => products, [products])
    if (!memoizedProducts) return <p>No products</p>
    if (loading) return <p>Loading...</p>
    if (error) return <p>{error}</p>

    const renderTempName = () => {
        return (
            <section>
                <h1>TempName</h1>
                <AddProduct />
                {renderProducts(memoizedProducts)}
            </section>
        )
    }


    const renderProducts = (memoizedProducts: Product[]) => {
        return (
            <div className="flex flex-wrap justify-center items-center gap-6">
                {memoizedProducts.map((product) => renderProduct(product))}
            </div>
        )
    }

    const renderProduct = (product: Product) => {
        const { _id } = product
        return (
            <div key={_id} className="flex gap-6">
                <CardMd data={product} />
                <UpdateProduct data={product} />
                <DeleteProduct id={_id} />
            </div>
        )
    }

    return renderTempName()
}