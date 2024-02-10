'use client'

import { useRouter } from "next/navigation"
import { useEffect, useState, useCallback, useMemo } from "react"
import { Product } from "@../../../types"
import { getProductById } from "@/lib/product"

type ProductDetailsProps = {
    id: string
    }

export default function ProductDetails({ id }: ProductDetailsProps) {

    const router = useRouter()
    const [product, setProduct] = useState<Product>()
    const [error, setError] = useState<string>('')  
    const [loading, setLoading] = useState<boolean>(false)

    const fetchProductData = useCallback(async (id: string) => {
        try {
            const product = await getProductById(id)
            return product         
        } catch (error) {
            setError('An error occurred')
        }
    }, [])

    useEffect(() => {
        setLoading(true)
        fetchProductData(id)
        .then((product) => {
            setProduct(product)
        })
        .catch((error) => {
            setError(error)
        })
        .finally(() => {
            setLoading(false)
        }
        )
    }
    , [fetchProductData, id])


    const memorizedProduct = useMemo(() => product, [product])
    if (error) return <div>{error}</div>
    if (loading) return <div>Loading...</div>
    if (!memorizedProduct) return <div>Product not found</div>
    const { title, description, price, inStock, category } = memorizedProduct


    const handleBack = () => {
        router.back()
    }

    const renderProduct = () => {
        return (
            <div>
                <h1>{title}</h1>
                <p>{description}</p>
                <p>{price}</p>
                <p>{inStock}</p>
                <p>{category}</p>
                <button onClick={handleBack}>Back</button>
            </div>
        )
    }

    return renderProduct()
}


