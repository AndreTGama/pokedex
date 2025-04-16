// src/app/layout.tsx
import { ReactQueryProvider } from '@/providers/ReactQueryProvider'
import { PokemonProvider } from '@/providers/PokemonProvider'
import '../styles/globals.css'
import { PageProvider } from '@/providers/PageProvider'
import { Navbar } from '@/components/navbar'

export const metadata = {
  title: 'Pokédex',
  description: 'Next.js Pokédex com Tailwind e React Query',
}

export default function RootLayout({ children }: { children: React.ReactNode }) {
  return (
    <html lang="pt-BR">
      <body>
        <ReactQueryProvider>
          <PokemonProvider>
            <PageProvider>
              <Navbar />
              <main className="p-4">{children}</main>
            </PageProvider>
          </PokemonProvider>
        </ReactQueryProvider>
      </body>
    </html>
  )
}
