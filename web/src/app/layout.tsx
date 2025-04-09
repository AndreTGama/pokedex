// src/app/layout.tsx
import './globals.css'
import { ReactQueryProvider } from '@/providers/ReactQueryProvider' // Confirme se é exportado com nome!

export const metadata = {
  title: 'Pokédex',
  description: 'Next.js Pokédex com Tailwind e React Query',
}

export default function RootLayout({ children }: { children: React.ReactNode }) {
  return (
    <html lang="pt-BR">
      <body>
        <ReactQueryProvider>
          <main className="p-4">{children}</main>
        </ReactQueryProvider>
      </body>
    </html>
  )
}
