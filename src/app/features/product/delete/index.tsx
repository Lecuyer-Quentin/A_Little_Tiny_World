import React from 'react'

import { deleteProduct } from '@/lib/product'
import { Button } from '@/components/ui/button'

export default function DeleteProduct({ id }: { id: string }) {

    const handleDelete = async (id: string) => {
        if(window.confirm('Are you sure you want to delete this product?'))
                await deleteProduct(id)
                window.location.reload()
    }
    

    const renderButton = () => {
        return (
            <Button onClick={() => handleDelete(id)} >Delete</Button>
        )
    }
  return renderButton()
}
