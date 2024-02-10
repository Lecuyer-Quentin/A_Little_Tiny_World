'use client'

import { fetchProducts } from "@/lib/product"
import { useEffect, useState, useCallback, useMemo } from "react"
import CardMd from "@/app/components/card/card-admin"
import UpdateProduct from "@/app/features/product/update"
import AddProduct from "@/app/features/product/add"
import DeleteProduct from "@/app/features/product/delete"
import { Product } from "../../../../../types"

export default function TempName() {

   

    

    //const sendEmail = async () => {
    //    const session = await getSession()
    //    const name = session?.user?.name || "John"
    //    const email = session?.user?.email || ""
    //    const subject = "Welcome to the app"
    //    const text = "This is a sample email template using Tailwind CSS."
    //    const react = EmailTemplate({firstName: name})
//
    //    try {
    //        const res = await fetch('/api/send', {
    //            method: 'POST',
    //            headers: {
    //                'Content-Type': 'application/json',
    //                'Access-Control-Allow-Origin': '*',
    //                'Access-Control-Allow-Methods': 'POST',
    //                'Access-Control-Allow-Headers': 'Content-Type'
    //            },
    //            body: JSON.stringify({email, subject, text, react})
    //        })
    //        const data = await res.json()
    //        console.log(data)
    //    } catch (error) {
    //        console.log(error)
    //    }
    //}



    //const renderSendEmail = () => {
    //    return (
    //        <div>
    //            <button onClick={sendEmail}>Send email</button>
    //        </div>
    //    )
    //}

    const renderTempName = () => {
        return (
            <div>
                <h1>TempName</h1>
               
            </div>
        )
    }


   
    return renderTempName()

  
}