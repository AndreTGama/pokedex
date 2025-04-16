'use client';

import { ReactNode, createContext, useContext, useState } from 'react';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';

interface PageContextType {
  total: number;
  setTotal: React.Dispatch<React.SetStateAction<number>>;
  page: number;
  setPage: React.Dispatch<React.SetStateAction<number>>;
  pages: number;
  setPages: React.Dispatch<React.SetStateAction<number>>;
  currentPage: number;
  setCurrentPage: React.Dispatch<React.SetStateAction<number>>;
  limit: number;
  setLimit: React.Dispatch<React.SetStateAction<number>>;
  nextPage: number;
  setNextPage: React.Dispatch<React.SetStateAction<number>>;
  prevPage: number;
  setPrevPage: React.Dispatch<React.SetStateAction<number>>;
  lastPage: number;
  setLastPage: React.Dispatch<React.SetStateAction<number>>;
}

// eslint-disable-next-line @typescript-eslint/no-explicit-any
const PageContext = createContext<any>(null);

const queryClient = new QueryClient();

export function PageProvider({ children }: { children: ReactNode }) {
  const [total, setTotal] = useState<number>(0);
  const [page, setPage] = useState<number>(1);
  const [pages, setPages] = useState<number>(0);
  const [currentPage, setCurrentPage] = useState<number>(1);
  const [limit, setLimit] = useState<number>(10);
  const [nextPage, setNextPage] = useState<number>(0);
  const [prevPage, setPrevPage] = useState<number>(0);
  const [lastPage, setLastPage] = useState<number>(0);
  
  const value: PageContextType = {
    total,
    setTotal,
    page,
    setPage,
    pages,
    setPages,
    currentPage,
    setCurrentPage,
    limit,
    setLimit,
    nextPage,
    setNextPage,
    prevPage,
    setPrevPage,
    lastPage,
    setLastPage,
  };

  return (
    <PageContext.Provider value={value}>
      <QueryClientProvider client={queryClient}>{children}</QueryClientProvider>
    </PageContext.Provider>
  );
}

export function usePage() {
  const context = useContext(PageContext);
  if (!context) {
    throw new Error('usePage deve ser usado dentro de um PageProvider');
  }
  return context;
}