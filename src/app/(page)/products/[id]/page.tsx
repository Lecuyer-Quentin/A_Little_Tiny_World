import ProductDetails from '@/app/ui/product-details'

export default function ProductPage({ params }: { params: { id: string } }){
    const { id } = params
  return (
    <>
        <ProductDetails id={id} />
    </>
  )
}
