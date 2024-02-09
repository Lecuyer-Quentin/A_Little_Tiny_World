'use client'

import { useForm } from 'react-hook-form'
import { useState } from 'react';
import { addProduct } from '@/lib/product';
import { Product } from "../../../../../types";
import { ProductModel } from '@/model/product';
import { Button } from '@/components/ui/button';

export default function AddProduct(){
    const [error, setError] = useState<string | null>(null)
    const [success, setSuccess] = useState<boolean>(false)
    const [loading, setLoading] = useState<boolean>(false)

    const { register, handleSubmit, formState, getValues } = useForm({
        defaultValues: {
            title: '',
            description: '',
            price: 0,
            inStock: true,
            category: '',
            }
    })

    const canSubmit = formState.isValid && !loading && !success && !error 

    const handleAddProduct = async () => {
        const product = getValues()
        try{
            setLoading(true)
            await addProduct(product as Product)
        } catch (error){
            setError('Error adding product')
        } finally {
            setLoading(false)
            setSuccess(true)
        }
    }

    const renderButton = () => {
        return (
            <Button onClick={handleAddProduct} disabled={!canSubmit}>
                Add product
            </Button>
        )
    }


    const renderForm = () => {
        return (
            <form className='flex flex-col border-2 p-4 w-fit gap-y-4 bg-gray-200 rounded-md'
                    onSubmit={handleSubmit(handleAddProduct)}>
                <div className="flex justify-between gap-x-4">
                    <label htmlFor="title">Titre: </label>
                    <input type="text" placeholder="Title" {...register('title')} />
                </div>
                <div className="flex justify-between gap-x-4">
                    <label htmlFor="description">Description: </label>
                    <input type="text" placeholder="Description" {...register('description')} />
                </div>
                <div className="flex justify-between gap-x-4">
                    <label htmlFor="price">Price:</label>
                    <input type="number" placeholder="Price" {...register('price')} />
                </div>
                <div className="flex justify-between gap-x-4">
                    <label htmlFor="category">Category:</label>
                    <input type="text" placeholder="Category" {...register('category')} />
                </div>
                <div className="flex justify-between gap-x-4">
                    <label htmlFor="inStock">In Stock:</label>
                    <input type="checkbox" {...register('inStock')} />
                </div>

                {renderButton()}

                {error && <p>{error}</p>}
                {success && <p>Product added</p>}
            </form>
           
        )
    }
    return renderForm()

}