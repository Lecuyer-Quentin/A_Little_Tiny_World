import { withAuth, NextRequestWithAuth } from "next-auth/middleware"
import { NextResponse } from "next/server"

const protectedRoute = [
    '/dashboard',
]

export default withAuth(
    
    function middleware(req: NextRequestWithAuth) {
        if ( protectedRoute.includes(req.nextUrl.pathname)
            && req.nextauth.token?.role !== 'admin'
            && req.nextauth.token?.role !== 'dev'
        ) {
            return (
                NextResponse.rewrite(
                    new URL('/denied', req.url)
                )
            )
        }
    console.log('Role', req.nextauth.token?.role)
    }      
)


export const config = {
    matcher: [
        '/dashboard',
    ],
}
            
