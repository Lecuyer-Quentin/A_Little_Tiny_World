import { getSession } from "next-auth/react"
import { Product } from "../../types"


export const addProduct = async (product: Product) => {
    const role = await getSession().then((session) => session?.token.role)
    if (role !== 'admin' && role !== 'dev') {
        alert('Unauthorized')
        throw new Error('Unauthorized')
    }
    try{
        const response = await fetch('/api/products', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(product)
        })
        if (response.ok){ 
            return response.json()
        } else {
            throw new Error('Error in response adding product')
        }
    } catch (error){
        throw new Error('Error adding product')
    }
}

export const fetchProducts = async () => {
    try{
        const response = await fetch('/api/products', {
            method: 'GET',
            headers: {'Content-Type': 'application/json'}
        })
        if (response.ok){
            const data = await response.json()
            return data.products
        } else {
            throw new Error('Error getting products')
        }
    } catch (error){
        throw new Error('Error getting products')
    }
}

export const getSortedProducts = async () => {
    const data = await fetchProducts()
    const sortedData = data.sort((a: Product, b: Product) => {
        return new Date(b.createdAt).getTime() - new Date(a.createdAt).getTime()
    })
    return sortedData
}

export const getProductById = async ( id : string) => {
    try{
        const data = await fetchProducts()
        const product = data.find((product: Product) => product._id === id)
        if (product){
            return product
        } else {
            throw new Error('Product not found')
        }
    } catch (error){
        throw new Error('Error getting product')
    }
}

export const updateProduct = async ( product : Product) => {
    const role = await getSession().then((session) => session?.token.role)
    if (role !== 'admin' && role !== 'dev') {
        alert('Unauthorized')
        throw new Error('Unauthorized')
    }
    const { _id } = product
    try{
        const response = await fetch(`/api/products/${_id}`, {
            method: 'PUT',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(product)
        })
        if (response.ok){
            return response.json()
        } else {
            throw new Error('Error in response updating product')}
    } catch (error){
        throw new Error('Error updating product')
    }
}

export const deleteProduct = async ( _id : string) => {
    const role = await getSession().then((session) => session?.token.role)
    if (role !== 'admin' && role !== 'dev') {
        alert('Unauthorized')
        throw new Error('Unauthorized')
    }
    try{
        const response = await fetch(`/api/products/${_id}`, {
            method: 'DELETE',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({ _id }),
        })
        if (response.ok){
            return response.json()
        } else {
            throw new Error('Error in response deleting product')
        }
    } catch (error){
        throw new Error('Error deleting product')
    }
}