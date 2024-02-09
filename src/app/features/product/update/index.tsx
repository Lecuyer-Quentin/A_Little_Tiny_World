import { useForm } from 'react-hook-form'
import { useState } from 'react';
import { updateProduct } from '@/lib/product';
import { Product } from '../../../../../types';



export default function UpdateProduct({ data }: { data: Product }) {

    const [error, setError] = useState<string | null>(null)
    const [success, setSuccess] = useState<boolean>(false)
    const [loading, setLoading] = useState<boolean>(false)


    const { register, handleSubmit, formState, getValues } = useForm({
        defaultValues: {
            _id : data._id,
            title: data.title,
            description: data.description,
            price: data.price,
            inStock: data.inStock,
            category: data.category,
        }
    })

    const canSubmit = formState.isValid && !loading && !success && !error

    const handleUpdateProduct = async () => {
        const product = getValues()
        try {
            setLoading(true)
            await updateProduct(product as Product)
        } catch (error) {
            setError('Error updating product')
        } finally {
            setLoading(false)
            setSuccess(true)
            window.location.reload()
        }
    }

    const renderForm = () => {
        return (
            <form className='flex flex-col border-2 p-4 w-auto gap-y-4 bg-gray-200 rounded-md'
                    onSubmit={handleSubmit(handleUpdateProduct)}>
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
                <div className="flex gap-x-4">
                    <label htmlFor="inStock">In Stock</label>
                    <input type="checkbox" {...register('inStock')} />
                </div>
                <button type="submit" disabled={!canSubmit}>Update product</button>
                {error && <p>{error}</p>}
                {success && <p>Product updated</p>}

            </form>
        )
    }


    return renderForm()
}