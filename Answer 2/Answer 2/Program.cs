using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Answer_2
{
    class Program
    {
        public static int Solution(int X, int[] A)
        {
            bool[] l = new bool[X + 1];
            int c = 0, s = 0;
            for (int i = 0; i < A.Length; i++)
            {
                if (i <= X)
                {
                    s += i;

                }
                 

                if (A[i] <= X && !l[A[i]])
                {
                    c += A[i];
                    l[A[i]] = true;
                }
                if (c == s && i >= X)
                {
                    return i;
                }
                  
                    
            }
            return -1;
        }
        static void Main(string[] args)
        {

            int[] A = { 1,3,1,4,2,3,5,4};
            int x = 5;
            int result = Solution(x, A);
            if(result>-1)
            {
                Console.WriteLine("Frog jump other side of the river in "+result+" seconds");

            }
            else
            {
                Console.WriteLine("The frog can not jump to the other side of the river");

            }
            
            
            Console.ReadKey();

            
        }
    }
}
