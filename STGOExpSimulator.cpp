#include <iostream>

int main()
{
	int maxXp = 100;
	int level = 1;

	for (int i = 0; i < 30; i++)
	{
		std::cout << ". Level:" << level << "  " << maxXp << std::endl;

		if (level < 10)
		{
			maxXp = maxXp + 50;
		}
		else if ((level < 20)&&(level >= 10))
		{
			maxXp = maxXp + (maxXp / 4);
		}
		else if ((level < 30) && (level >= 20))
		{
			maxXp = maxXp + (maxXp / 3);
		}

		level++;
	}


    
}

