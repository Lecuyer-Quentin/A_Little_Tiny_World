import ProductDetailsAdmin from '@/app/ui/dashboard/product-details'

export default function ProductPage({ params }: { params: { id: string } }){
    const { id } = params
  return (
    <>
        <ProductDetailsAdmin id={id} />
    </>
  )
}
